<?php

class CheckVideoPreviewCest {

    public function _before(AcceptanceTester $I) {

    }

    /**
     * Original Scenario
     * 
     * 1) Open https://yandex.ru/video/
     * 2) Search video by text "ураган"
     * 3) Wait search results
     * 4) Move mouse to any video on left panel
     * 5) Check video has trailer
     */
    public function tryToTest(AcceptanceTester $I, \Component\Search $search, \Component\Main $main, \Component\Video $video) {
        $I->amOnPage('/');

        $search->search("ураган");
        $main->waitLoader();

        $video->moveToVideoAndWaitLoadPreview(1);
        $video->checkVideoTrailerExist(1);
        $video->moveToVideoAndWaitLoadPreview(2);
        $video->checkVideoTrailerExist(2);
        $video->moveToVideoAndWaitLoadPreview(3);
        $video->checkVideoTrailerExist(3);
    }

}