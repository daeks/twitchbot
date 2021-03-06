<?php

  $cmd = array('level' => 'admin owner',
               'count' => false,
               'help' => 'Enable <command> for channel');
  
  if($execute) {
    if($this->isadmin($this->target) || $this->isowner()) {
      if(isset($this->data[4])) {
        $this->data[4] = strtolower($this->data[4]);
        if(in_array(substr($this->data[4], 0, 1), $this->cmdtriggers)) {
          if(in_array($this->data[4], $this->db[$this->target]['config']['banned_cmds'])) {
            $this->db[$this->target]['config']['banned_cmds'] = $this->remove($this->db[$this->target]['config']['banned_cmds'], $this->data[4]);
            $this->save();
            $this->say($this->target, true, '@'.$this->username.' command enabled');
          }
        } else if($this->data[4] == '*') {
          $this->db[$this->target]['config']['banned_cmds'] = array();
          $this->save();
          $this->say($this->target, true, '@'.$this->username.' all commands enabled');
        }
      } 
    }
  }
  
?>