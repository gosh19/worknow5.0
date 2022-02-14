<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block mb-3 font-weight-bolder" data-toggle="modal" data-target="#exampleModal">
    Crear Publicacion <i class="fas fa-file-import"></i>
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-none-blue">
          <h5 class="modal-title text-primary " id="exampleModalLabel"><b>CREA TU PUBLICACION <i class="fas fa-file-import"></i></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('Post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="texto">Texto a publicar</label>
                <textarea class="form-control" maxlength="5000" name="text" id="texto" placeholder="Escribe tu publicacion..." required></textarea>
            </div>
            <div class="mb-3">
                <label for="img1"><b class="text-info">Imagen 1 :</b></label>
                <input id="img1" type="file" name="img[0]" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="img2"><b class="text-info">Imagen 2 :</b></label>
                <input id="img2" type="file" name="img[1]" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="img3"><b class="text-info">Imagen 3 :</b></label>
                <input id="img3" type="file" name="img[2]" accept="image/*">
            </div>
            <hr>
            <div class="row justify-content-center">

                <input type="submit" value="Cargar" class="btn btn-primary">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>