<?php
namespace Component;

class Video {

    private string $video = "(//*[contains(@class, 'serp-item__thumb')])[index]";
    private string $video_loader = "(//*[contains(@class, 'serp-item__thumb')])[index]//*[contains(@class, 'thumb-preview__loader')]";

    private \AcceptanceTester $tester;

    public function __construct(\AcceptanceTester $I) {
        $this->tester = $I;
    }

    public function moveToVideoAndWaitLoadPreview($video_number) {
        $I = $this->tester;

        $I->moveMouseOver($this->getVideoLocator($video_number));
        $I->waitForElementNotVisible($this->getVideoLoaderLocator($video_number));
    }

    public function checkVideoTrailerExist($video_number) {
        $I = $this->tester;

        $file1 = "preview_1";
        $file1_full = codecept_log_dir() . "debug" . DIRECTORY_SEPARATOR . "preview_1.png";
        $file2 = "preview_2";
        $file2_full = codecept_log_dir() . "debug" . DIRECTORY_SEPARATOR . "preview_2.png";

        if (file_exists($file1_full)) {
            unlink($file1_full);
        }
        if (file_exists($file2_full)) {
            unlink($file2_full);
        }

        $I->makeElementScreenshot($this->getVideoLocator($video_number), $file1);
        sleep(1);
        $I->makeElementScreenshot($this->getVideoLocator($video_number), $file2);

        $I->assertFileNotEquals($file1_full, $file2_full, "First and second preview equals.");
    }

    private function getVideoLocator($video_number) : string {
        return str_replace("index", $video_number, $this->video);
    }

    private function getVideoLoaderLocator($video_number) : string {
        return str_replace("index", $video_number, $this->video_loader);
    }

}