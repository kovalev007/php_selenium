<?php
namespace Component;

class Main {

    private string $loader= "//*[contains(@class, 'fade_region_main')]";

    protected \AcceptanceTester $tester;

    public function __construct(\AcceptanceTester $I) {
        $this->tester = $I;
    }

    public function waitLoader() {
        $I = $this->tester;

        $I->waitForElement($this->loader);
        $I->waitForElementNotVisible($this->loader);
    }

}