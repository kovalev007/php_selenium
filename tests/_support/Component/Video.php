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

    /**
     * Gets two screenshots with between interval 1 sec and compare
     * 
     * TODO need think how we can provide test class name to prevent collisions with parallel execution of tests
     */
    public function checkVideoTrailerExist($video_number) {
        $I = $this->tester;

        $file1 = "preview_1";
        $file1_full = codecept_log_dir() . "debug" . DIRECTORY_SEPARATOR . "preview_1.png";
        $file2 = "preview_2";
        $file2_full = codecept_log_dir() . "debug" . DIRECTORY_SEPARATOR . "preview_2.png";

        $this->deleteFile($file1_full);
        $this->deleteFile($file2_full);

        $I->makeElementScreenshot($this->getVideoLocator($video_number), $file1);
        sleep(1);
        $I->makeElementScreenshot($this->getVideoLocator($video_number), $file2);

        $I->assertFileNotEquals($file1_full, $file2_full, "First and second preview equals.");
    }

    private function deleteFile($file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    private function getVideoLocator($video_number) : string {
        return str_replace("index", $video_number, $this->video);
    }

    private function getVideoLoaderLocator($video_number) : string {
        return str_replace("index", $video_number, $this->video_loader);
    }

}