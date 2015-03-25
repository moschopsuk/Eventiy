<?php

class PostController extends Controller {

	public function postAdd() {


		$post_base					= new Post;
		$post_base->user_id			= Input::get('user_id');
		$post_base->event_id		= Input::get('event_id');
		$post_base->payload_type	= Input::get('payload_type');

		switch($post_base->payload_type) {
			case "text":
				$post = Post_Text::create(Input::only('header', 'body'));
				$post->post()->save($post_base);
				break;

			case "tweet":
				$post = Post_Tweet::create(Input::only('tid', 'tuid', 'name', 'screen_name', 'avatar', 'text'));
				$post->post()->save($post_base);	
				break;

			case "photo":

				$name = str_random(12);
				$ext = Input::file('file')->guessExtension();
				$fileName = $name . "." . $ext;

				//If the image is a gif we just move it
				//or else the image is rescaled and a thumb made.
				if ($ext == "gif") { 
					$file = Input::file('file');

					$file->move(public_path() . "/images/photos/", $fileName);
					File::copy(public_path() . "/images/photos/" . $fileName, public_path() . "/images/photos/thumbs/" . $fileName);

				} else {
					
					//Roate the image if uploaded from a mobile device
					$source = Image::make(Input::file('file'))->orientate();
					$source->save(public_path() . "/images/photos/" . $fileName);

					$img = Image::make(Input::file('file'));
					$img->resize(500, 500, function ($constraint) {
			            $constraint->aspectRatio();
			        });

			        $img->save(public_path() . "/images/photos/thumbs/" . $fileName);
				}

				$data = array(
			       'caption' 		=> Input::get('caption'),
			       'filename' 		=> $fileName,
				);

				$post = Post_Photo::create($data);
				$post->post()->save($post_base);	

				break;
		}
		
		//If successful puss the data to redis for the realtime updates
		$redis = Redis::connection();
		$redis->publish('post.new', json_encode(array('base' => $post_base, 'payload' => $post)));

		return Response::json(array('sucess' => true, 'base' => $post_base, 'payload' => $post));
	}

	public function getPosts($id) {

		$data = array();

		foreach (Post::where('event_id', $id)->with('postable')->get() as $post)
		{
			$data[] = array("base" => $post, "payload" => $post->postable);
		}

		return Response::json(array_reverse($data));
	}

	public function getPostsScoll($id, $page) {

		$data = array();

		foreach (Post::where('event_id', $id)->with('postable')->orderBy('created_at', 'desc')->skip($page)->take(10)->get() as $post)
		{
			$data[] = array("base" => $post, "payload" => $post->postable);
		}

		return Response::json($data);
	}

	public function getPostsSpec($id, $type, $limit) {
		$data = array();

		foreach (Post::where('event_id', $id)->where('payload_type', $type)->with('postable')->orderBy('created_at', 'DESC')->take($limit)->get() as $post)
		{
			$data[] = array("base" => $post, "payload" => $post->postable);
		}

		return Response::json(array_reverse($data));
	}
}


?>


