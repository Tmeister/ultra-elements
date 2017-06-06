<?php
namespace UltraElements\Modules\UltraDivider;

use UltraElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_widgets() {
        return [
            'UltraDivider',
        ];
    }

    public function get_name() {
        return 'ultra-divider';
    }
}
