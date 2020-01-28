<?php
    session_start();
    echo "<pre>";
    print_r($_POST);
    // die();

    // echo $_POST["accountfName"];
    echo "<br>";

    // function getValues($sectionName) {
    //     return (isset($_POST[$sectionName]) ? $_POST[$sectionName] : [] );
    // }

    function getFieldValue($section, $fieldName) {
        return (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : "" );
    }

    function setValues($sectionName) {
        (isset($_POST[$sectionName]) ? $_SESSION[$sectionName] = $_POST[$sectionName] : [] );
    }

    function getSessionValues($sectionName) {
        return (isset($_SESSION[$sectionName]) ? $_SESSION[$sectionName] : [] );
    }

    if(isset($_POST['account'])) {
        setValues('account');
    }
    print_r(getSessionValues('account'));
    // print_r(getValues('account'));
    // echo "<br>";
    // // echo getFieldValue('fName');
    // print_r($_POST[['account']['fName']]);
    // echo "</pre>";
?>