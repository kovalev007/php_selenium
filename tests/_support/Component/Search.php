<?php
namespace Component;

class Search {

    private string $form_input = "//*[contains(@class, 'input__control')]";
    private string $form_button = "//*[contains(@class, 'websearch-button__text')]";

    private \AcceptanceTester $tester;

    public function __construct(\AcceptanceTester $I) {
        $this->tester = $I;
    }

    public function search($text) {
        $I = $this->tester;

        $I->fillField($this->form_input, $text);
        $I->click($this->form_button);
        $I->click($this->form_button); //TODO need investigate frontend sources why we should add sleep or additional click to hide panel with results
    }

}