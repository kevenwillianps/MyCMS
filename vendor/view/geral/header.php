<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm" id="nav-main">

    <div class="container">

        <a type="button" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GERAL&ACTION=HOME')" class="navbar-brand">

            <img src="image/logo.png" width="30" alt="MyCMS - Souza Consultoria Tecnológica" loading="lazy"> <strong>My</strong>CMS

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frmUsuario" aria-controls="frmUsuario" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE')">

                        <i class="far fa-user-circle mr-1"></i><?php echo utf8_encode(ucwords(strtolower(@(string)$_SESSION['USER_NAME_FIRST'])))?>

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top shadow-sm">

    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frmUsuario" aria-controls="frmUsuario" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class="fas fa-cog mr-1"></i>Configurações

                    </a>

                    <div class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID')">

                            Empresa

                        </a>

                        <a class="dropdown-item" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_IMAGE_PREFERENCE_DATAGRID')">

                            Imagens

                        </a>

                    </div>

                </li>

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID')">

                        <i class="fas fa-cog mr-1"></i>Situação

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DATAGRID')">

                        <i class="fas fa-highlighter mr-1"></i>Marcadores

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID')">

                        <i class="fas fa-users mr-1"></i>Usuários

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_DATAGRID')">

                        <i class="fas fa-filter mr-1"></i>Categoria

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" type="button" id="navbarDropdown" role="button" onclick="request('FOLDER=VIEW&TABLE=CONTENTS&ACTION=CONTENTS_DATAGRID')">

                        <i class="far fa-clipboard mr-1"></i>Conteúdo

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>