<?php

/**
 * Any changes made in the Right Statement list must be reflected here to display labels and links to right statements correctly. 
 * 
 */

class Rights
{
    /**
     * Generates a full HTML tag with the label and URL of a specified rights statement based on the provided rights group.
     *
     * @param string $rights_group The parent of the rights statement in the vocabulary. It categorizes and groups related rights statements.
     *
     * @param string $rights_statement The specific rights statement to be used. 
     *
     * @return string The generated HTML tag containing the label and URL of the specified rights statement within the given rights group.
     */
    public function rightsstatement($rights_group, $rights_statement, $version = false)
    {

        $group_identifier = $this->extractIdentifier($rights_group);
        $rights_identifier = $this->extractIdentifier($rights_statement);

        if ($group_identifier == "CC") {
            if (!$version) {
                $version = "4.0";
            }
            $this->ccLicenseLabel($version, explode("-", $rights_identifier));
        }
        elseif ($group_identifier == "PD"){
            if (!$version){
                $version = "1.0";
            }
            $this->pdMarkLabel($version, $rights_identifier);
        }elseif (explode("-", $group_identifier)[0] == "RS") {
            if(!$version){
                $version = "1.0";
            }
            $this->rightsStatementLabel($version, $rights_statement, $group_identifier);
        }
    }
    /**
     * Construct a Creative Commons label
     * 
     * @param string $version Text with the version of the CC license. For instance: 4.0
     * @param array $segments list with the components of the license. For instance ["by", "nc"]
     */

    public function ccLicenseLabel($version, $segments)
    {
        print "<label>License</label>";
        print '<p xmlns:cc="http://creativecommons.org/ns#" >This work is licensed under <a href="http://creativecommons.org/licenses/'.join("-", $segments).'/'.$version.'/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC '.strtoupper(join("-", $segments)).' '.$version.' <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1">';
        foreach($segments as $segment){
            print '<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/'.$segment.'.svg?ref=chooser-v1">';
        }
        print '</a></p>';
    }

    /**
     * @param string $version
     * @param string $identifier Text that helps to identify the class of Public Domain attribution.
     * 
     */
    public function pdMarkLabel($version, $identifier){
        
        print "<label>License</label>";
        print '<p xmlns:cc="http://creativecommons.org/ns#" >This work is marked with <a href="http://creativecommons.org/publicdomain/';
        print ($identifier == "pd") ? "mark" : $identifier;
        print '/'.$version.'?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">';
        print ($identifier == "pd") ? "PDM " : "CC0 ";
        print $version.'<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/'.$identifier.'.svg?ref=chooser-v1"></a></p>';
    }

    /**
     * 
     * 
     */
    public function rightsStatementLabel($version, $statement, $identifier) {
        $label_identifier = explode("-", $identifier)[1];
    
        $statement_components = explode("(", $statement);
        $identifier_part = trim(str_replace(['(', ')'], '', $statement_components[1]));
    
        $label = "https://rightsstatements.org/files/icons/" . $label_identifier . ".Icon-Only.dark.svg";
        print "<label>Right Statement</label>";
    
        print '<p><a href="https://rightsstatements.org/page/' . $identifier_part . '/' . $version . '/" target="_blank" style="display:inline-block;"><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="' . $label . '"> ' . $statement_components[0] . '</a></p>';
    }
    

    /**
     * Extracts and trims the identifier from a string containing parentheses.
     *
     * @param string $inputString The input string containing parentheses.
     * @return string The trimmed identifier.
     */
    public function extractIdentifier($inputString)
    {
        return trim(str_replace(['(', ')'], '', explode("(", $inputString)[1]));
    }
}
