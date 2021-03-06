<?php

  $cmd = array('level' => 'none permit op admin owner',
               'count' => false,
               'help' => 'Displays common commands');
  
  if($execute) {
    $tmp = array();
    foreach (scandir(CMDS_PATH) as $include){
      if(is_file(CMDS_PATH.DIRECTORY_SEPARATOR.$include) && strpos($include, '..') == 0 && strtoupper(pathinfo($include, PATHINFO_EXTENSION)) == 'PHP'){
        $name = basename(CMDS_PATH.DIRECTORY_SEPARATOR.$include, '.'.pathinfo(CMDS_PATH.DIRECTORY_SEPARATOR.$include, PATHINFO_EXTENSION));
        try {
            $execute = false;
            include(CMDS_PATH.DIRECTORY_SEPARATOR.$include);
            if(in_array('none', explode(' ', $cmd['level']))) {
              $name = str_replace('BOTNAME', BOTNAME, $name);
              array_push($tmp, $name);
            }  
          } catch (Exception $e) {
            $this->error($e);
          }  
      }
    }
    foreach($this->db[$this->target]['config']['plugins'] as $ext => $config) {
      if(is_dir(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext)) {
        foreach (scandir(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext) as $include){
          if(is_file(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.$include) && strpos($include, '..') == 0 && strpos($include, '.include.') == 0 && strtoupper(pathinfo($include, PATHINFO_EXTENSION)) == 'PHP'){
            $name = basename(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.$include, '.'.pathinfo(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.$include, PATHINFO_EXTENSION));
            try {
                $execute = false;
                include(PLUGINS_PATH.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.$include);
                if(in_array('none', explode(' ', $cmd['level']))) {
                  $name = str_replace('BOTNAME', BOTNAME, $name);
                  array_push($tmp, $name);
                }  
              } catch (Exception $e) {
                $this->error($e);
              }  
          }
        }
      }
    }
    $this->say($this->target, true, trim('- Commands of '.$this->target.': '.implode(' ', $tmp).' '.implode(' ', array_keys($this->db[$this->target]['data']['cmds']))));
  }
  
?>