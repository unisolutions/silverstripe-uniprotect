<?php
/**
 * @package uniprotect
 */

/**
 * Protecter class to handle spam protection interface
 */
class UniProtectProtector implements SpamProtector
{

    /**
     * Return the Field that we will use in this protector
     *
     * @return string
     */
    public function getFormField($name = "UniProtectField", $title = "UniProtect", $value = null)
    {
        return new UniProtectField($name, $title, $value);
    }

    /**
     * Not used by uniprotect
     */
    public function setFieldMapping($fieldMapping)
    {
    }
}
