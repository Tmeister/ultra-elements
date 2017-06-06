<?php
namespace UltraElements\Modules\HelloWorld;

use UltraElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_widgets() {
        return [
            'HelloWorld',
        ];
    }

    public function get_name() {
        return 'hello-world';
    }
}
