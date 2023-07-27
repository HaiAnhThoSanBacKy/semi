<?php
                $ern = "";
                if ($_SERVER['REQUEST_METHOD']=="POST")
                {
                    if(isset($_REQUEST['button']) == true)
                    {
                        $c=0;
                        if (empty($_REQUEST['rnum']))
                            $ern = "Roll number is required";
                        else {
                          $name = $_REQUEST['rnum'];
                          if (!preg_match("/^[0-9 ]*$/",$name))
                            $ern = "Please Enter correct Data";
                            else{
                                $c = $c +1;
                            }
                        }
                        if($c == 1)
                        {
                            $myfile = fopen("data.txt", "r") or die("Unable to open file!");
                            $temp = fopen("temp1.txt", "a+") or die("Unable to open file!");
                            $c = 0;
                            while(!feof($myfile))
                            {
                                $d =fgets($myfile);
                                $c++;
                            }
                            $delete = false;
                            rewind($myfile);
                            for($i=1; $i< $c;$i++)
                            {
                                $d=fgets($myfile);
                                $data = explode("\t",$d);
                                $name = $_REQUEST['rnum'];
                                
                                if($data[0]==$name)
                                {
                                    echo '<img src="images/delete1.gif" width=400 style="margin-top: 25px;">';
                                    $delete = true;

                                }
                                else if($data!=$name){
                                    if(isset($data[0]))
                                    {
                                        fwrite($temp,$data[0]."\t");
                                    }

                                    if(isset($data[1]))
                                    {
                                        fwrite($temp,$data[1]."\t");
                                    }
                                    if(isset($data[2]))
                                    {    
                                        fwrite($temp,$data[2]."\t");
                                    }
                                    if(isset($data[3]))
                                    {    
                                        fwrite($temp,$data[3]."\t");
                                    }
                                    if(isset($data[4]))
                                    {    
                                        fwrite($temp,$data[4]."\t");
                                    }
                                    if(isset($data[5]))
                                    {    
                                        fwrite($temp,$data[5]."\t");
                                    }
                                    if(isset($data[6]))
                                    {   
                                        fwrite($temp,$data[6]."\t");
                                    }
                                    if(isset($data[7]))
                                    {    
                                        fwrite($temp,$data[7]."\t");
                                    }    
                                    if(isset($data[8]))
                                    { 
                                        fwrite($temp,$data[8]);
                                    }
                                }
                            }
                            if(!$delete)
                            {
                                echo '<div class="errorMsg">Data Not Found</div>';
                                    echo '<img src="images/found1.png" width=330 style="margin-top: 10px;">';
                            }
                            fclose($temp);
                            fclose($myfile);
                            unlink("data.txt");
                            rename("temp1.txt","data.txt");
                         }
                    }
                }
                ?>