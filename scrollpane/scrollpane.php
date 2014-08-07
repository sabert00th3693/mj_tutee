<html>
    <head>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        
        <!-- scrollpane -->
        <link type="text/css" href="jsScrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
        <script type="text/javascript" src="jsScrollpane/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="jsScrollpane/jquery.jscrollpane.min.js"></script>
        
        <script>
            /* scrollpane */
            $(function(){
                $('.scroll-pane').jScrollPane();
                
                $(".jspDrag").hide();
                $(".scroll-pane").mouseover(function() {
                        $(this).find(".jspDrag").stop(true,true).delay(100).fadeIn(600);

                });
                $(".scroll-pane").mouseleave(function() {
                        $(this).find(".jspDrag").stop(true,true).delay(200).fadeOut(700);
                });
            });
        </script>
        <style>
            .main-content{
                padding: 10px;
                border: 1px solid rgba(0, 0, 0, 0.5);
                width: 500px;
            }
            .content {
                height: 500px;
                width: 100%;
            }
            
            .scroll-pane
            {
                height: 200px;
                overflow: hidden;
            }
            .jspContainer {
                width: 496px;
            }
            .jspVerticalBar {
                width: 8px;
                background-color: #fff;
            }
            .jspTrack {
                background-color: #fff;
            }
            .jspDrag {
                border-radius: 5px;
                background:none repeat scroll 0 0 #7f7f7f
            }
        </style>
    </head>
    <body>
        <div class="main-content">
            <div class="scroll-pane" id="ex3">
                <div class="content">
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                    Example 3<br/>
                </div>
           </div>
        </div>
          
    </body>
</html>