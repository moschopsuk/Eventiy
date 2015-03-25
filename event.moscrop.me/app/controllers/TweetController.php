<?php

class TweetController extends Controller {

	public function postTweets()
	{
		$hashtag = Input::get('hashtag');


		$tweets = Twitter::getSearch([
		    'q' 				=> $hashtag,
		    'count' 			=> 20,
		    'result_type' 		=> 'mixed'
		]);

		return Response::json($tweets);
	}

}