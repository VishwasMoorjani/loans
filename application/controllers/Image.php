<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image extends CI_Controller {
    
    public function resize() {
        // basic info
        error_reporting(E_ALL);
        $path = ''.$this->uri->uri_string();
        $path = "/assets/".$path;
        //echo $path; die;
        //unlink($path);

        if(!file_exists($path))
        {
            //echo "Te";
            $pathinfo = pathinfo($path);
            
            $tmp = explode("-", $pathinfo["filename"]);
            $size = end($tmp);
            //$size = end(explode("-", $pathinfo["filename"]));
            $patho = $pathinfo["dirname"].'/';
            // $original = 'http://192.168.1.55/clear_united/'.$patho . str_ireplace("-" . $size, "", $pathinfo["basename"]);
            $original = $_SERVER['DOCUMENT_ROOT'].'/exam/'.$patho . str_ireplace("-" . $size, "", $pathinfo["basename"]);
          //  echo $original; die;
          //  original image not found, show 404
           // echo site_url().$original;
            if (!file_exists($original)) {
                show_404($original);
            }
           // die("Mil gayi");
           // load the allowed image sizes
           
            $allowed = TRUE;
            
            if (stripos($size, "x") !== FALSE) {
                // dimensions are provided as size
                @list($width, $height) = explode("x", $size);
               
                // security check, to avoid users requesting random sizes
               
            } else if (isset($sizes[$size])) {
                // optional, the preset is provided instead of the dimensions
                // NOTE: the controller will be executed EVERY time you request the image this way
                @list($width, $height) = $sizes[$size];
                $allowed = TRUE;
                
                // set the correct output path
               echo  $path = str_ireplace($size, $width . "x" . $height, $path); die;
            }
            $new_image = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/tmpimg/'.basename($path);
            if (file_exists($new_image)) 
            {
                
                $output = $new_image;
            }
            else
            {
                // only continue with a valid width and height
                if ($allowed && $width > 0 || $height > 0) 
                {
                    @mkdir("assets/uploads/tmpimg/",0775,true);
                    @chmod("assets/uploads/tmpimg/", 0775);
                    $new_image = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/tmpimg/'.basename($path);
                    //echo $new_image; die;
                    
                    // initialize library
                    $config["source_image"] = $original;
                    //$config['new_image'] = $path;
                    $config['new_image'] = $new_image;
                    $config["width"] = $width;
                    $config["height"] = $height;
                    $config['maintain_ratio'] = TRUE;
                    $config["dynamic_output"] = FALSE; // always save as cache
                    
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($config);
                    
                    $this->image_lib->resize();
                    //$this->image_lib->crop();
                }
                //echo $new_image; die('df');
                // check if the resulting image exists, else show the original
                if (file_exists($new_image)) 
                {
                    $output = $new_image;
                } 
                else 
                {
                    $output = $original;
                }
            }
        }
        else
        {
            echo $output=$path; die;
            
        }
        $info = getimagesize($output);
        
        // output the image
        header("Content-Disposition: filename={$output};");
        header("Content-Type: {$info["mime"]}");
        header('Content-Transfer-Encoding: binary');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        
        readfile($output);
    }
}