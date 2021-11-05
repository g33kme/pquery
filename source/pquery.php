<?php

namespace g33kme\pquery;

class PQUERY {

    /**
     * Let's construct! 
     */
    public function __construct() {

    }

    /*
     * $x = type, url, update, name, role, style, class, id
     */
    public static function form($x=false) {

		$x['type'] = !empty($x['type']) ? $x['type'] : 'GET';

		$onSubmit = '$.ajax({ url: "'.$x['url'] .'", data: $(this.elements).serialize(), success: function(response){ $("'.$x['update'] .'").html(response); }, type: "'.$x['type'].'", dataType: "html" }); return false';

		$form = '<form role="'.$x['role'].'" style="'.$x['style'].'" class="'.$x['class'].'" name="'.$x['name'].'" id="'.$x['id'].'" ';
		$form .= 'action="'.$x['url'].'" onsubmit=\''.$onSubmit.'\' ';
		$form .= 'method="'.$x['type'].'"> ';

        return $form;

	}

    /*
     * $x = type, url, update, role, style, class, jloader, id, name
     */
	public static function link($x=false) {


        $x['type'] = !empty($x['type']) ? $x['type'] : 'GET';

        $onClick = '$("'.$x['jloader'] .'").show(); $.ajax({url: "'.$x['url'] .'", success: function(response) { $("'.$x['update'].'").html(response);}, type: "'.$x['type'].', dataType: "html" }); return false;';

        $link = '<a style="'.$x['style'].'" class="'.$x['class'].'" class="'.$x['role'].'" id="'.$x['id'].'" href="javascript:void(0);" onclick=\''.$onClick.'\'>'.$x['name'].'</a>';
            
        return $link;


	}

	public static function cleanStop($stop) {
		return array_unique(array_values(array_filter($stop)));
	}

    public static function randHash($lng, $numericOnly=false) {

        mt_srand(crc32(microtime()));

        if($numericOnly) {
            $b = "1234567890";
        } else {
            $b = "abcdefghijklmnpqrstuvwxyz1234567890";
        }

       $str_lng = strlen($b)-1;
       $rand= "";

       for($i=0;$i<$lng;$i++)
          $rand.= $b{mt_rand(0, $str_lng)};

       return $rand;
    }

    public static function cleanRequest() {

		$done = array();
		foreach($_REQUEST as $key => $value) {
			if(is_array($value)) {

				foreach($value as $k => $v) {

					$valueClean = trim(strip_tags($v));
					$valueClean = addslashes($valueClean);
					$done[$k] = $valueClean;
				}

			} else {

				$valueClean = trim(strip_tags($value));
				$valueClean = addslashes($valueClean);
				$done[$key] = $valueClean;

			}
		}
		return $done;

	}


}

?>