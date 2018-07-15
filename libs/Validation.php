
<?php

/**
 * Validation Class 
 *
 * @package     formvalid
 * @subpackage  validate
 * @category    Validation
 * @author  customs by TungNT
 * @link   stackoverflow
 */

class Validation  {

    private $error = array();
    private $formdata = array();
    private $form_is_valid = 1;

    public function _construct() {

    }

    public function validate() {
        $this->formdata = filter_input_array(INPUT_POST);
    }

    public function valid($name, $label, $valid_type, $custom_msg = NULL, $same_as_control_name=NULL) {
        $validation_type = explode('|', rtrim($valid_type, '|'));
        foreach ($validation_type as $validate):
            if ($validate == "trim"):
                $val = trim($this->formdata[$name]);
            else:
                $is_true = $this->call_validation($validate, $this->formdata[$name]);
                if ($is_true === 1):
                    $val = $this->formdata[$name];
                elseif ($is_true === 2):
                    $this->set_error($name, "Validation Method Not Exists");
                else:
                    if (strpos($validate, '[') !== false):
                        $expMethod = explode('[', $validate,2);
                        $validate = $expMethod[0];
                        $arg2 = str_replace(']', '', $expMethod[1]);
                        if (method_exists($this, $validate)):
                                if($validate=="equalTo"):
                                    $msg = $this->set_message($validate, $name, $label, $same_as_control_name, $custom_msg);
                                    $this->set_error($name, $msg);
                                else:
                                    $msg = $this->set_message($validate, $name, $label, $arg2, $custom_msg);
                                    $this->set_error($name, $msg);
                                endif;

                        endif;
                    else:
                        $msg = $this->set_message($validate, $name, $label, $this->formdata[$name], $custom_msg);
                        $this->set_error($name, $msg);
                        $val = $this->formdata[$name];
                    endif;

                endif;
            endif;
        endforeach;
        return $val;
    }

    private function call_validation($function_name, $value) {
        $respone = 2;
        if (method_exists($this, $function_name)):
            $respone = $this->$function_name($value);
        else:
            if (strpos($function_name, '[') !== false):
                $expMethod = explode('[', $function_name,2);
                $function_name = $expMethod[0];
                $arg2 = str_replace(']', '', $expMethod[1]);
                if (method_exists($this, $function_name)):
                    if($function_name=="equalTo"):
                        $respone = $this->$function_name($value,$this->formdata[$arg2],$value);
                    else:
                        $respone = $this->$function_name($value,$arg2);
                    endif;

                endif;
            endif;
        endif;
        return $respone;
    }

    private function set_message($method_name, $name, $label, $val, $message = NULL) {
        if (empty($message)):
            if (empty($label)):
                return "{$name} " . $this->method_msg($method_name, $val);
            else:
                return "{$label} " . $this->method_msg($method_name, $val);
            endif;
        else:
            return $message;
        endif;
    }

    private function method_msg($method_name, $val = NULL) {
        switch ($method_name) :
            case "numeric": $msg = "phải ở dạng số";
                break;
            case "email": $msg = "không hợp lệ!";
                break;
            case "alphabetic": $msg = "Định dạng chữ cái!";
                break;
            case "alphanumeric": $msg = "only alpha numeric!";
                break;
            case "url": $msg = "không phải là url";
                break;
            case "phone": $msg = "không phải định dạng là số";
                break;
            case "date": $msg = "không phải định dạng ngày tháng";
                break;
            case "equalTo": $msg = "Không trùng nhau $val!";
                break;
            case "min_length": $msg = "Ký tự tối thiểu $val";
                break;
            case "max_length": $msg = "Ký tự tối đa $val";
                break;
            default:
                $msg = "Trường nhập bắt buộc!";
                break;
        endswitch;
        return $msg;
    }

    private function set_error($name, $message) {
        $this->form_is_valid = 0;
        $this->error["error_" . $name] = $message;
    }

    public function is_valid() {
        return $this->form_is_valid;
    }

    public function error($error_control) {
        if (isset($this->error[$error_control]) && !empty($this->error[$error_control])):
            return $this->error[$error_control];
        else:
            return '';
        endif;
    }

    /**
     * required
     * 
     * @param mixed $value
     * @return boolean
     */
    protected function required($value) {
        $val = trim($value);
        return (empty($val)) ? 0 : 1;
    }

    /**
     * numeric
     * 
     * @param int $value
     * @return boolean
     */
    protected function numeric($value) {
        return !(empty($value)) ? (preg_match("/^([0-9]*)$/", $value)) ? 1 : 0 : 0;
    }

    /**
     * email
     * 
     * @param mixed $value
     * @return boolean
     */
    protected function email($value) {
        return !(empty($value)) ? (filter_var($value, FILTER_VALIDATE_EMAIL)) ? 1 : 0 : 0;
    }

    /**
     * alphabetic
     * 
     * @param mixed $value
     * @return boolean
     */
    protected function alphabetic($value) {
        return !(empty($value)) ? (preg_match("/^[a-zA-Z ]*$/", $value)) ? 1 : 0 : 0;
    }

    /**
     * alphanumeric
     * 
     * @param mixed $value
     * @return boolean
     */
    protected function alphanumeric($value) {
        return !(empty($value)) ? (preg_match("/^[-_a-zA-Z0-9. ]*$/", $value)) ? 1 : 0 : 0;
    }

    /**
     * url
     * 
     * @param mixed $value
     * @return boolean
     */
    protected function url($value) {
        return !(empty($value)) ? (filter_var($value, FILTER_VALIDATE_URL)) ? 1 : 0 : 0;
    }

    /**
     * phone
     * 
     * @param int $value
     * @return boolean
     */
    protected function phone($value) {
        return !(empty($value)) ? (preg_match("/^\+?[0-9\-]+\*?$/", $value)) ? 1 : 0 : 0;
    }

    /**
     * date
     * 
     * @param date $value
     * @return boolean
     */
    protected function date($value) {
        $val = date("Y-m-d", strtotime($value));
        return ($val == "1970-01-01" || $val == "0000-00-00") ? 0 : 1;
    }

    /**
     * equalTo
     * 
     * @param mixed $value1
     * @param mixed $value2
     * @return boolean
     */
    protected function equalTo($value1, $value2) {
        return !(empty($value1)) ? ($value1 == $value2) ? 1 : 0 : 0;
    }

    /**
     * min_length
     * 
     * @param int $value1
     * @param int $value2
     * @return boolean
     */
    protected function min_length($value1, $value2) {
        return !(empty($value1)) ? (strlen($value1) >= $value2) ? 1 : 0 : 0;
    }

    /**
     * max_length
     * 
     * @param int $value1
     * @param int $value2
     * @return boolean
     */
    protected function max_length($value1, $value2) {
        return !(empty($value1)) ? (strlen($value1) <= $value2) ? 1 : 0 : 0;
    }

}

?>
