<?php
    function suggest($string)
    {
        $suggestions = array();

        // Suggests possible words in case of misspelling
        $config_dic = pspell_config_create('en');

        // Ignore words under 2 characters
        pspell_config_ignore($config_dic, 2);

        // Configure the dictionary
        pspell_config_mode($config_dic, PSPELL_FAST);
        $dictionary = pspell_new_config($config_dic);

        if (!pspell_check($dictionary, $string)) {
            $suggestions = pspell_suggest($dictionary, $string);
        }

        return $suggestions;
    }

//usage
$suggestions = suggest("wordl");