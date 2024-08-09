$(document).ready(function () {
  'use strict'
  /*configuracion de tabla de matriculados*/

  $('#mat-lista').DataTable({
    "paging": true,
    "lengthChange": false,
    "pageLength": 80,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
    }
  });

  $('#mat-grados').DataTable({
    "paging": false,
    "lengthChange": false,
    "pageLength": 80,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": true,
    "responsive": true,
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
    }
  });

  $('#asig-lista').DataTable({
    "paging": false,
    "lengthChange": false,
    "pageLength": 80,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
    }
  });

  $('#alum-reporte').DataTable({
    "paging": false,
    "lengthChange": false,
    "pageLength": 80,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "responsive": true,
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
    }
  });

  $("#tablageneral").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "order": false,
    "pageLength": 100,
    "buttons": ["excel", "pdf", "print"],
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      buttons: {
        "print": "Imprimir"
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: ',
    }
  }).buttons().container().appendTo('#tablageneral_wrapper .col-md-6:eq(0)');

  $("#icfes-tab").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "order": false,
    "pageLength": 100,
    "buttons": ["excel", "pdf", "print"],
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      buttons: {
        "print": "Imprimir"
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: ',
    }
  }).buttons().container().appendTo('#tablageneral_wrapper .col-md-6:eq(0)');

  $("#icfes-revision").DataTable({
    "paging": true,
    "lengthChange": false,
    "pageLength": 1000,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'language': {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Último',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
    }
  })

  return false
});
