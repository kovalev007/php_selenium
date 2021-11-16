<?php

class CheckVideoPreviewCest {

    public function _before(AcceptanceTester $I) {

    }

    // tests
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