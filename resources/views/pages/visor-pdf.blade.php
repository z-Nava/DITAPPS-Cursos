@extends('pages.app')

@section('content')
    <div id="pdf-viewer"></div>

    <script src="{{ asset('js/pdfjs/pdf.js') }}"></script>
    <script>
        // Cargar el archivo PDF
        var url = "{{ asset('storage/' . $rutaArchivo) }}";
        var pdfViewer = document.getElementById('pdf-viewer');
        var pdfWorker = "{{ asset('js/pdfjs/pdf.worker.js') }}";

        // Iniciar el visor PDF con opciones de visualización personalizadas
        PDFJS.getDocument({ url: url, workerSrc: pdfWorker }).then(function(pdfDoc) {
            // Configurar las opciones de visualización
            var options = {
                viewerContainer: pdfViewer,
                disablePrinting: true, // Deshabilitar la opción de impresión
                disableDownload: true // Deshabilitar la opción de descarga
            };

            // Cargar el visor PDF con las opciones de visualización
            pdfDoc.getPage(1).then(function(page) {
                page.getViewport({ scale: 1 }).then(function(viewport) {
                    var pdfViewer = new PDFJS.PDFViewer(options);
                    pdfViewer.setDocument(pdfDoc);
                    pdfViewer.currentScaleValue = 'page-fit';
                    pdfViewer.scrollMode = 0;
                    pdfViewer.container.scrollTop = 0;
                    pdfViewer.update();

                    // Opcional: Ajustar el tamaño del visor PDF al contenedor
                    window.addEventListener('resize', function() {
                        pdfViewer.currentScaleValue = 'page-fit';
                        pdfViewer.update();
                    });
                });
            });
        });
    </script>
@endsection

