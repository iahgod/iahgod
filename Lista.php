<?=$render('header', ['loggedUser'=>$loggedUser, 'admin'=>true, 'title'=>'Configurações', 'menu'=>$menu]);?>

<!-- MAIN CONTENT-->
<div class="main-content">

<div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12" style="padding:0;">

                        <div class="card-header">
                            <strong>Menu e Sub-menus</strong>
                        </div>

                        <div class="card-body">
                            <?php if(!empty($flash)):?>
                                 <p class="erro"><?=$flash?></p>
                            <?php endif;?>
                            <table class="tabela">
                                <thead>
                                    <tr class="table-info text-dark">
                                        <th scope="col">ID</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Ordem</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($MenuAdmin as $item):?>
                                        <tr>
                                            <th scope="row"><?=$item['id']?></th>
                                            <td><?=$item['titulo']?></td>
                                            <td><?=$item['url']?></td>
                                            <td><?=$item['ordem']?></td>
                                            <td>
                                                <a href="<?=$base;?>/admin/form-projeto/<?=$item['id']?>" class="btn btn-primary btn-sm">Editar</a>
                                                <a href="#" onclick="certeza('<?=$base;?>/admin/projeto/excluir/<?=$item['id']?>')" class="btn btn-danger btn-sm">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>

                            <table class="tabela">
                                <thead>
                                    <tr class="table-info text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Id Menu</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Menu_Admin_Sub as $item):?>
                                        <tr>
                                            <th scope="row"><?=$item['id']?></th>
                                            <td><?=$item['titulo']?></td>
                                            <td><?=$item['url']?></td>
                                            <td><?=$item['id_menu']?></td>
                                            <td>
                                                <a href="<?=$base;?>/admin/form-projeto/<?=$item['id']?>" class="btn btn-primary btn-sm">Editar</a>
                                                <a href="#" onclick="certeza('<?=$base;?>/admin/projeto/excluir/<?=$item['id']?>')" class="btn btn-danger btn-sm">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">

                        </div>

                    </div>

                </div>
            </div>
</div></div>


<?=$render('footer', ['loggedUser'=>$loggedUser]);?>