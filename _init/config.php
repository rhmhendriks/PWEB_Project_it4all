<?php
    #########################################################################
    #####                                                               #####
    ##### THIS IS THE MAIN CONFIGURATION FILE FOR THE ENTIRE WEBSITE    #####
    #####                                                               #####
    ##### In this file we store all configurations for the entire       #####
    ##### website including all funtions, forms and style.              #####
    #####                                                               #####
    ##### Please update all lines starting with "//" carefully!         #####
    #####                                                               #####
    #########################################################################

    ## This file is created on 12/10/2019 at 09:03 AM
    ## This file is created by Ronald HM Hendriks

    // Last updated on 17/01/2021 at 09:48 AM
    // Last edited by Ronald HM Hendriks

    ## What did you edit and why?
    //////////////////////////////////////////////////////////////////////////
    // Added the mail configuration for global use. Also the mail server    //
    // is self-hosted from now on!                                          //
    //////////////////////////////////////////////////////////////////////////

        ### The files start below ###
            // Below we have the databse parameters
            define("ServerName", "localhost:3306");
            define("DBSigninName", "it4alldbuser");
            define("DBKey", "It4llit4all2019!");
            define("DBname", "IT4all NEW");

            // Below we have some site settings
            define("imagesfolder", "_images");
            define(MaxLoginAttempts, 5);
        
            // Now we do some development settings
            define("DebugisOn", true)
?>