<?php
    /* Require configuration */
    require_once("includes/config.php");
    /* Require libraries */
    require_once("includes/nusoap/nusoap.php");
    /* Require database */
    require_once("includes/db.php");
    /* Register NuSOAP Server */
    $server = new nusoap_server;
    $server->configureWSDL(WS_NAME, WS_URL);
    /* Require complex types */
    require_once("includes/complex_types.php");
    /* Require api functions */
    require_once("includes/api.php");

/* Register Call Methods */
    $server->register('listEduCources', array(), array("result"=>"tns:Array"), WS_URL); 
    $server->register('setEduCourse', array("param"=>"tns:EduCourse"), array("result"=>"xsd:int"), WS_URL);
    $server->register('removeEduCourse', array("param"=>"xsd:int"), array("result"=>"xsd:int"), WS_URL);
    $server->register('addParticipant', array("param"=>"tns:Participant"), array("result"=>"xsd:int"), WS_URL);
    $server->register('removeParticipant', array("param"=>"xsd:int"), array("result"=>"xsd:int"), WS_URL);
    $server->register('setAssignment', array("param"=>"tns:Assignment"), array("result"=>"xsd:int"), WS_URL);
    $server->register('removeAssignment', array("param"=>"xsd:int"), array("result"=>"xsd:int"), WS_URL);
    $server->register('getProgressTable', array("param"=>"xsd:int"), array("result"=>"xsd:string"), WS_URL);
    $server->register('getCourseLinkingConnections', array("param"=>"xsd:int"), array("result"=>"xsd:string"), WS_URL);
    $server->register('getCoursePosts', array("param"=>"tns:Array"), array("result"=>"xsd:string"), WS_URL);
    $server->register('getCourseComments', array("param"=>"tns:Array"), array("result"=>"xsd:string"), WS_URL);
    $server->register('getCoursePostById', array("param"=>"xsd:int"), array("result"=>"xsd:string"), WS_URL);
    
/* Auth check */
    function isAuthenticated() {
        if(isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW']) ) {
            if($_SERVER['PHP_AUTH_USER']==WS_USERNAME and $_SERVER['PHP_AUTH_PW']==WS_PASSWORD ) {
                return true;
            }            
        }
        return false;
    }
      
/* Call Functions */
    /* Function getCoursePosts */
    function getCoursePosts($param) {
        global $db;
        return $db->getCoursePosts($param);
    }
    /* Function getCourseComments */
    function getCourseComments($param) {
        global $db;
        return $db->getCourseComments($param);
    }
    /* Function getCoursePostById */
    function getCoursePostById($param) {
        global $db;
        return $db->getCoursePostById($param);
    }
    // Returns list of course IDs
    function listEduCources() {
        global $db;
        return $db->listEduCources();
    }
    
    /* Function setEduCource */
    // adds or modifies eduCourse
    function setEduCourse($param) {
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->setEduCourse($param);
    }
    /* Function removeEduCource */
    // removes eduCourse
    function removeEduCourse($param) {      
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->removeEduCourse($param);
    }
    /* Function addParticipant */
    function addParticipant($param) {
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->addParticipant($param);
    }
    /* Function removeParticipant */
    function removeParticipant($param) {
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->removeParticipant($param);
    }
    
    /* Function setAssignment */
    function setAssignment($param) {
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->setAssignment($param);
    }
    /* Function removeAssignment */
    function removeAssignment($param) {
        global $db;
        // need authentication
        return !isAuthenticated() ? 0 : $db->removeAssignment($param);
    }
    
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
?>