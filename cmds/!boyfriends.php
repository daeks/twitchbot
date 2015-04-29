<?php

  $cmd = array('level' => 'none',
               'count' => true,
               'help' => 'Displays the amount of the boyfriend queue');
  
  if($execute) {
    $subcommand = rtrim($this->data[3], 's');
    $this->say($this->target, false, ucfirst(ltrim($this->target, '#')).' could choose between '.(isset($this->db[$this->target]['stats']['cmds'][$subcommand]) ? $this->db[$this->target]['stats']['cmds'][$subcommand] : 0).' possible boyfriends. This takes some time to evaluate. Please be patient. Kappa');
  }
  
?>