<?php 
    $id_usuario = $this->session->funcionario->id_usuario;

    $menus = $this->main->getListSelect('menu', 'accion.*, menu.id_menu', ['preferencia'=>'ASC'], ['id_usuario'=>$id_usuario, 'id_estado'=>1, 'es_menu'=>'SI'], null, null, ['accion'=>'id_accion']);    
?>

<div data-sticky-container>
    <div class="title-bar" data-sticky data-margin-top>
      
      <div class="title-bar-title">Sistema de Propuestas</div>

      <div class="title-bar-right">
        <ul class="dropdown menu align-right" data-dropdown-menu>

          <?php foreach ($menus as $menu) : ?>
            <li>
              <?php $ruta = ($menu->ruta_amigable) ? $menu->ruta_amigable : '#' ; ?>

              <a href="<?=site_url($ruta)?>" ><i class="<?=$menu->icon?>"></i><span><?=$menu->nombre_accion?></span></a>
              <?php $submenus = $this->main->getListSelect('menu', 'accion.*, menu.id_menu', ['id_menu'=>'ASC'], ['id_usuario'=>$id_usuario, 'id_estado'=>1, 'es_submenu'=>'SI', 'id_padre'=>$menu->id_accion], null, null, ['accion'=>'id_accion']); ?>

              <?php if($submenus): ?>
              <ul class="menu">
                <?php foreach ($submenus as $submenu) : ?>
                  <li>
                    <a href="<?=site_url($submenu->ruta_amigable)?>">
                      <i class="<?=$submenu->icon?>"></i><span><?=$submenu->nombre_accion?></span>
                    </a>

                    <?php $sub_submenus = $this->main->getListSelect('menu', 'accion.*, menu.id_menu', ['id_menu'=>'ASC'], ['id_usuario'=>$id_usuario, 'id_estado'=>1, 'es_sub_submenu'=>'SI', 'id_padre'=>$submenu->id_accion], null, null, ['accion'=>'id_accion']); ?>

                    <?php if($sub_submenus): ?>
                      <ul class="menu">
                      <?php foreach ($sub_submenus as $sub_submenu) : ?>
                        <li>
                          <a href="<?=site_url($sub_submenu->ruta_amigable)?>">
                            <i class="<?=$sub_submenu->icon?>"></i><span><?=$sub_submenu->nombre_accion?></span>
                          </a>
                        </li>
                      <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
                <?php endif; ?>
            </li>
          <?php endforeach; ?> 
        </ul>
      </div>
    </div>
  </div>
