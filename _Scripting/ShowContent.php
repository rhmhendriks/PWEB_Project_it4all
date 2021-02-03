 <?php     
        ### RenderCustomerPage ###
            //////////////////////////////////////////////////////////////////
            // Render Customer Pages                         //
            //--------------------------------------------------------------//
            // This function determins the right content on index           //
            // the function can use the following:                          //
            //  - ArticleCategory                                           //          
            //  - Article                                                   //
            //  - GenPage                                                   //
            //  - AdminPage                                                 //
            //  - Auth                                                      //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Script created on 02/10/2019                                 ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 03/02/2021 09:37 AM by Ronald HM Hendriks       //
            //////////////////////////////////////////////////////////////////
                 if(isset($_GET['GenPage'])){
                     $GenPage = $_GET['GenPage'];
                     include $GenPage.php;
                 } elseif (isset($_GET['AdminPage'])) {
                     $AdminPage = $_GET['AdminPage'];
                     include $AdminPage.php;
                 } elseif (isset($_GET['Auth'])) {
                     $Auth = $_GET['Auth'];
                     include $Auth.php;
                 } elseif (isset($_GET['Article'])){
                     $ArticleID = $_GET['Article'];
                     ShowArticle($ArticleID);
                 } elseif (isset($_Get['ArticleCategory'])){
                     $ArticleCategory = $_GET['ArticleCategory'];
                        if ($ArticleCategory == 0){
                            ShowArticleCollection(0);
                        } else {
                            ShowArticleCollection($ArticleCategory);
                        }
                } else {
                    ShowError('InvalidPageID');
                }
?>