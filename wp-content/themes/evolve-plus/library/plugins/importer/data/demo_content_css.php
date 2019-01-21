<?php

$import_demo_content_css = '';

$import_demo_content_css .= "   
/* New Heading Tag */

h7 {
    font-size: 14px;
    line-height: 14px;
    padding: 5px 0px;
    margin-bottom: 15px;
}

/* Meet the team */

.person-author-wrapper {
    display: block;
    text-align: center;
    color: #000 !important;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 0px solid rgba(0, 0, 0, 0.1);
}

.person-author-wrapper .person-name {
    font: 20px/25px 'Poppins', arial, helvetica, sans-serif;
    font-weight: 900 !important;
}

.person-author-wrapper .person-title {
    font: 14px/18px 'Poppins', arial, helvetica, sans-serif;
    font-weight: normal !important;
    color: #aaa!important;
}

.person-author-wrapper span {
    display: block;
}

.person-author a {
    display: inline-block;
    height: 19px;
}


/* Content Boxes Shortcode */ 

.content-boxes-icon-boxed .content-box-column {
    border-radius: 4px;
}

.t4p-columns-4 {
    margin-left: 0px;
    margin-right: 0px;
}

.t4p-content-boxes .col {
    width: 100%;
}

.t4p-content-boxes {
    margin-bottom: 60px;
    margin-top: 60px;
    max-width: 100%;
}

.t4p-content-boxes .t4p-column {
    margin-bottom: 20px;
}

.t4p-content-boxes .heading {
    overflow: hidden;
    margin-bottom: 15px;
}

.t4p-content-boxes .heading .heading-link:hover .content-box-heading {
    color: #0BB697;
}

.t4p-content-boxes .heading .heading-link:hover .fontawesome-icon {
    background-color: #0BB697;
    border-color: #0BB697;
}

.t4p-content-boxes .heading .content-box-heading {
    margin: 0;
}

.t4p-content-boxes .content-container .button-more {
    display: block;
    margin: 18px 0 0;
    text-align: center;
}

.t4p-content-boxes .content-container .read-more {
    font-size: 33px;
    text-shadow: 0px 1px 0px rgba(0, 0, 0, 0.3);
    padding-left: 10px;
    padding-right: 10px;
    cursor: pointer;
    font-weight: normal;
    border: 1px solid #444;
    background: transparent -moz-linear-gradient(center top, #606060 20%, #505050 100%) repeat scroll 0% 0%;
    box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.3) inset, 0px 1px 2px rgba(0, 0, 0, 0.29);
    color: #FFF !important;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon {
    display: table;
    width: auto;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon .heading-link,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon .heading-link {
    display: block;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon .icon,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon .icon,
.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon .image,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon .image {
    display: table-cell;
    vertical-align: middle;
    float: none;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon img,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon img {
    margin-right: 10px;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon .fontawesome-icon,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon .fontawesome-icon {
    display: block;
    float: none;
    margin-right: 5px;
}

.t4p-content-boxes.content-boxes-icon-with-title .heading-with-icon .content-box-heading,
.t4p-content-boxes.content-boxes-icon-on-side .heading-with-icon .content-box-heading {
    display: table-cell;
    vertical-align: middle;
    line-height: normal;
}

.t4p-content-boxes.content-boxes-icon-on-side .content-container {
    padding-left: 45px;
}

.t4p-content-boxes.content-boxes-icon-on-top .heading {
    text-align: center;
}

.t4p-content-boxes.content-boxes-icon-on-top .heading .icon {
    margin-bottom: 5px;
}

.t4p-content-boxes.content-boxes-icon-on-top .heading .fontawesome-icon {
    display: block;
    float: none;
    margin: 0 auto;
    height: 64px;
    width: 64px;
    line-height: 64px;
    font-size: 24px;
}

.t4p-content-boxes.content-boxes-icon-on-top .content-container,
.t4p-content-boxes.content-boxes-icon-on-top .read-more {
    text-align: center;
}

.t4p-content-boxes.content-boxes-icon-boxed {
    overflow: visible;
}

.t4p-content-boxes.content-boxes-icon-boxed .content-wrapper-boxed {
    overflow: visible;
    padding: 50px 18px 18px 18px;
    text-align: center;
    margin: 0px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.08), 0px 0px 0px 1px rgba(0, 0, 0, 0.07) inset;
}

.t4p-content-boxes.content-boxes-icon-boxed .heading {
    overflow: visible;
    position: relative;
    text-align: center;
}

.t4p-content-boxes.content-boxes-icon-boxed .heading .fontawesome-icon {
    display: block;
    position: absolute;
    left: 50%;
    top: -80px;
    float: none;
    margin-left: -32px;
    height: 64px;
    width: 64px;
    line-height: 64px;
    font-size: 24px;
}

.t4p-content-boxes.content-boxes-icon-boxed .heading .image {
    display: block;
    position: absolute;
    left: 50%;
}

.t4p-content-boxes.content-boxes-icon-boxed .content-container,
.t4p-content-boxes.content-boxes-icon-boxed .read-more {
    text-align: center;
}


/* Images */

.entry-content img,
.entry-content .wp-caption {
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0);
    height: auto;
    padding: 5px;
    border: 1px solid rgba(255, 255, 255, .95);
    background: rgba(255, 255, 255, .8);
}


/* Flickr & Portfolio Widget */

.widget .flickr_badge_image img,
.widget .recent-works-items img {
    width: 65px;
    height: 65px;
    float: left;
    margin: 3px;
    border: 5px solid rgba(0, 0, 0, 0);
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}


/* Posts */

.evolve-container.layout-thumbnails-on-side .col {
    margin-bottom: 20px;
}

.evolve-container.layout-thumbnails-on-side .flexslider {
    width: 144px;
    float: left;
    overflow: hidden;
    margin-right: 20px;
}

.evolve-container.layout-thumbnails-on-side .recent-posts-content h3 {
    clear: none;
    margin-top: 0;
    font-size: 20px;
}

.evolve-container.layout-thumbnails-on-side .recent-posts-content h4 {
    margin: 0;
    margin-bottom: 3px;
}

.evolve-container.layout-thumbnails-on-side .recent-posts-content .meta {
    margin-bottom: 15px;
    color: rgba(0, 0, 0, 0);
    !important;
}

.evolve-container.layout-icon-on-side .col {
    margin-bottom: 20px;
}

.evolve-container.layout-icon-on-side .date-and-formats {
    width: 45px;
    float: left;
    overflow: hidden;
    margin-right: 20px;
}

.evolve-container.layout-icon-on-side .recent-posts-content h3 {
    clear: none;
    margin-top: 0;
    font-size: 20px;
}

.evolve-container.layout-icon-on-side .recent-posts-content h4 {
    margin: 0;
    margin-bottom: 3px;
}

.evolve-container.layout-icon-on-side .recent-posts-content .meta {
    margin-bottom: 15px;
    color: #bbb!important;
}

.date-and-formats .format-box i {
    display: block;
    font-size: 25px;
    padding: 20px;
}

.evolve-container.layout-thumbnails-on-side .columns-1 .flexslider,
.evolve-container.layout-thumbnails-on-side .columns-2 .flexslider {
    margin-bottom: 5px;
}

.one_half,
.one_third,
.two_third,
.three_fourth,
.one_fourth {
    margin-right: 4%;
    float: left;
    line-height: 21px;
    margin-bottom: 20px;
    position: relative;
}

.one_half {
    width: 48%;
}

.one_third {
    width: 30.6666%;
}

.two_third {
    width: 65.3332%;
}

.one_fourth {
    width: 22%;
}

.three_fourth {
    width: 74%;
}

#content .last {
    margin-right: 0 !important;
    clear: right;
}

.clearboth {
    clear: both;
    display: block;
    font-size: 0px;
    height: 0px;
    line-height: 0;
    width: 100%;
    overflow: hidden;
}

.shortcode-tabs .tab-hold .tabs li {
    border-right: 0 !important;
}

.shortcode-tabs .tab-hold .tabs li a {
    display: block !important;
    width: 100% !important;
    padding: 0 !important;
    text-indent: 15px !important;
    font-size: 15px!important;
    height: 48px!important;
}

.shortcode-tabs .tab-hold .tabs li.active a {
    background: #f6f6f6;
    color: #333!important;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.4);
}

.shortcode-tabs .tab_content {
    padding: 15px !important;
    overflow: hidden;
}

.shortcode-tabs .tab_content *:last-child {
    margin-bottom: 0;
}

.shortcode-tabs {
    margin-bottom: 50px;
}

.share-box {
    margin-top: 55px;
    margin-bottom: 55px;
}

.share-box h3 {
    color: #999 !important;
    font-weight: normal;
}

.share-box ul {
    clear: both;
    float: none;
    display: block;
    text-align: center;
    list-style: none;
    margin: 0;
    padding: 0;
}

.share-box li {
    display: inline-block;
    float: none;
    list-style: none;
    margin: 0;
    padding: 0;
    margin-right: 6px;
    position: relative;
}

.share-box li a {
    float: left;
}


/* Images */

.entry-content img,
.entry-content .wp-caption {
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0);
    height: auto;
    padding: 5px;
    border: 1px solid rgba(255, 255, 255, 0);
    background: rgba(255, 255, 255, 0);
}

p:empty {
    display: none !important;
}

.entry-content {
    color: #686868 !important;
}

.entry-content h1 {
    color: #000000 !important;
}

.person-author-wrapper .person-name {
    font: 20px/25px 'Open Sans', arial, helvetica, sans-serif !important;
}


/* for entertainment page */

.radio .col .heading img {
    float: none;
    margin: 0 auto 15px;
}

";