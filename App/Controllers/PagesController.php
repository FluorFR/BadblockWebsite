<?php

namespace App\Controllers;

use App\Controllers\Api\YoutubeApi;
use HansOtt\PSR7Cookies\SetCookie;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PagesController extends Controller
{

	public function getHome(RequestInterface $request, ResponseInterface $response)
	{
        $info = $this->redis->getjson('ip_'.$request->getAttribute('ip_address'));

        $firstRow = $this->redis->getJson('first_row_posts');
		$secondRow = $this->redis->getJson('second_row_posts');
		$postsCount = $this->redis->get('posts_count');

		$this->render($response, 'pages.home', [
			'first_row' => $firstRow,
			'second_row' => $secondRow,
			'posts_count' => $postsCount,
            'info' => $info
		]);
	}

    public function getPlay(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.play');
    }

    public function getYoutube(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.youtube');
    }

    public function getYoutubeurs(ServerRequestInterface $request, ResponseInterface $response)
    {

        $this->render($response, 'pages.youtubeur', ['data' => YoutubeApi::getChannelList()]);
        //var_dump(YoutubeApi::getTChannel("UC042bAvKzEP4rrcWtl_bPDg"));
    }

    public function getPlayAdwords(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.play-adwords');
    }

    public function getPlayWindows(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.play-windows');
    }

    public function getPlayLinux(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.play-linux');
    }

    public function getPlayMac(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages.play-mac');
    }




    public function shuffle_assoc($array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return $new;
    }

	public function getStaff(RequestInterface $request, ResponseInterface $response)
	{

		$staff = $this->redis->getJson('staff.list');
		$nb = $this->redis->getJson('staff.number');

		foreach ($staff as $key => $row){
		    shuffle($staff[$key]['data']);
        }



		$this->render($response, 'pages.staff', [
			'staff' => $staff,
			'nb' => $nb,
		]);

	}

	public function getPodium(ServerRequestInterface $request, ResponseInterface $response)
	{
		return $this->render($response, 'stats.podium');
	}


    public function getinfo(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'pages.info');
    }

	
	public function bbnews(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'pages.bbnews');
    }

    public function getMT(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'legals.mt');
    }

    public function getCgu(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'legals.cgu');
    }

    public function getCgv(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'legals.cgv');
    }

    public function getCdc(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'legals.cdc');
    }



}