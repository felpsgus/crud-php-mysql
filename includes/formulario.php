<main>

  <section>
    <a href="index.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-3"><?=TITLE?></h2>

  <form method="post">

    <div class="form-group">
      <label class="mb-3">Título</label>
      <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
    </div>

    <div class="form-group">
      <label class="mt-3 mb-3">Descrição</label>
      <textarea name="descricao" class="form-control" rows="5"><?=$obVaga->descricao?></textarea>
    </div>

    <div class="form-group">
      <label class="mt-3">Status</label>

      <div class="mt-3 mb-3">

        <div class="form-check form-check-inline ps-0">

          <label class="form-control">
            <input type="radio" name="ativo" value="s" checked> Ativo
          </label>

        </div>

        <div class="form-check form-check-inline">

          <label class="form-control">
            <input type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : '' ?>> Inativo
          </label>

        </div>

      </div>

    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button>
    </div>

  </form>

</main>