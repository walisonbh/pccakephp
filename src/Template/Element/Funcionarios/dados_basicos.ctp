<?php
echo $this->Form->control('nome');
echo $this->Form->control('cpf', ['label' => 'CPF']);
echo $this->Form->control('matricula', ['label' => 'Matrícula']);
echo $this->Form->control('salario', ['label' => 'Salário']);
echo $this->Form->control('pais', ['label' => 'País', 'append' => '<span class"glyphicon glyphicon-search" aria-hidden="true"></span>']);
echo $this->Form->control('estado', ['append' => '<span class"glyphicon glyphicon-search" aria-hidden="true"></span>']);
echo $this->Form->control('cidade', ['append' => '<span class"glyphicon glyphicon-search" aria-hidden="true"></span>']);
echo $this->Form->control('Estado Civil');
echo $this->Form->control('Tem Filhos', ['type' => 'checkbox']);
