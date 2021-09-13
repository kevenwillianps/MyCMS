<div class="row animate slideIn">

    <div class="col-md-12 text-center">

        <img src="image/logo.png" alt="" width="50px">

        <div class="my-3">

            <h4 class="">

                Crie a sua conta no

                <strong>

                    WebSoftwiki

                </strong>

            </h4>

        </div>

    </div>

    <div class="col-md-4 mx-auto">

        <div class="card shadow-sm">

            <div class="card-body">

                <form class="row" role="form" id="formUsuarioLogin">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="nome_completo">

                                Nome Completo <span class="text-danger">*</span>

                            </label>

                            <input type="text" class="form-control" name="nome_completo" id="nome_completo">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="login">

                                Nome de Usuário <span class="text-danger">*</span>

                            </label>

                            <input type="text" class="form-control" name="login" id="login">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="login">

                                Função <span class="text-danger">*</span>

                            </label>

                            <input type="text" class="form-control" name="funcao" id="funcao">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="cpf">

                                CPF para acesso <span class="text-danger">*</span>

                            </label>

                            <input type="text" class="form-control" name="cpf" id="cpf">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <button type="button" class="btn btn-primary btn-block" onclick="sendForm('#formUsuarioLogin')">

                            <i class="far fa-paper-plane mr-1"></i>Registrar

                        </button>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION"/>
                    <input type="hidden" name="PRODUCT" value="GR"/>
                    <input type="hidden" name="ACTION" value="0"/>
                    <input type="hidden" name="situacao" value="I"/>
                    <input type="hidden" name="TABLE" value="GUSUARIO"/>
                    <input type="hidden" name="ACTION" value="G_USUARIO_REGISTER"/>

                </form>

            </div>

        </div>

        <button type="button" class="btn btn-outline-primary btn-block mt-3" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_LOGIN')">

            Já possui cadastro? <strong>Acesse a sua conta</strong>

        </button>

    </div>

</div>