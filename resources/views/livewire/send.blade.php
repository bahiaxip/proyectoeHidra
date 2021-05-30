<div wire:ignore.self class="modal fade" id="send" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <div class="modal-title h5" id="exampleModalLabel">Exportar
        </div>
      </div>
      <div class="modal-body justify-content-center">        
        <div class="row justify-content-around">
          <p>
            <button class="btn btn-sm c_grad_green" wire:click="exportPDF" data-dismiss="modal">
              PDF
            </button>
            <button class="btn btn-sm c_grad_green" wire:click="exportExcel" data-dismiss="modal">
              Excel
            </button>
            <button class="btn btn-sm c_grad_green" type="button" data-toggle="collapse" data-target="#collapseExport" aria-expanded="false" aria-controls="collapseExample">
              Email
            </button>
          </p>
        </div>
        <div wire:ignore.self class="collapse pt-3" id="collapseExport">
          <div class="card card-body">
            <form wire:submit.prevent>
              <div class="form-group text-center">
                  <label for="sendEmail">Email</label>
                  <input type="text" name="sendEmail" id="sendEmail" class="form-control form-control-sm" wire:model="emailParaExportar">
                  @error('emailParaExportar')
                  <p class="text-danger">{{$message}}</p>
                  @enderror
              </div>

              <div class="row justify-content-around">

                <div class="form-check form-check-inline">

                  <input class="form-check-input" type="checkbox" id="checkpdf"  value="" wire:model="checkpdf">
                  <label class="form-check-label" for="checkpdf">PDF</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="checkexcel" value="" wire:model="checkexcel">
                  <label class="form-check-label" for="checkexcel">Excel</label>
                </div>
                
                <button class="btn btn-sm c_grad_green" wire:click="sendEmail">Enviar</button>
                @if(session()->has('check'))
                    <div class="text-danger ">{{session('check')}}</div>
                @endif
              </div>
            </form>
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>        
      </div>
    </div>
  </div>
</div>