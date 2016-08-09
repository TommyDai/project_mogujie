<?php
session_set_cookie_params(604800);

#控制器,模型,视图路径
const CONTROLLER_PATH         = './controller/index/';
const MODEL_PATH              = './model/';
const VIEW_PATH               = './view/index/';
const URL_PATH                = 'index';
const UPLOAD_PATH             = './userhead/';


#全局配置文件
require './config/config.php';