<?php
function smarty_modifier_mobilephone($value) {
    return Utility::mobilephone($value);
}