<header class="app">
            <div class="grid">
                <div class="left">
                    <!-- <a href="">
                        <div id="menu" class="button">
                             <img src="_img/5-IconeMenu.png" alt="">
                        </div>
                    </!--> -->
                </div>
                <div class="center">
                    <p id="user-name">Olá <?php echo $_SESSION['nome']; ?></p>
                </div>
                <!-- <div class="right">
                    <a  id="edit-button" href="">
                    <div class="button">
                          <img src="_img/4-IconeEditar.png" alt="">
                    </div></a>
                </div> -->
                <div class="right2">
                    <a id="notif-button" href="sair.php">
                    <div class="button">
                          <img src="_img/7-IconeLogout.png" alt="">
                    </div></a>
                </div>
                <div class="bottom">
                    <div class="info">
                        <p id="busy">Quartos ocupados: <span><?php echo total("SELECT detalhes_status FROM detalhes WHERE detalhes_status=1"); ?></span></p>
                        <p id="free">Quartos disponíveis: <span><?php echo total("SELECT detalhes_status FROM detalhes WHERE detalhes_status=0"); ?></span></p>
                    </div>
                </div>
            </div>
        </header>