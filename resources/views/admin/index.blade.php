@extends('layouts.admin')

@section('title', 'Título por Defecto')

@section('content')
<div class="content">
  <main class="container">
    <h4>Estudiantes Vinculacion con la Sociedad- Verificacion</h4>

    <div class="form-group">
      <input id="searchInput" class="form-control" placeholder="Buscar...">
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-success">
        <thead>
          <tr>
            <th>Nombre Completo</th>
            <th>Cedula</th>
            <th>Correo Electrónico</th>
            <th>Ciudad</th>
            <th>Cohorte</th>
            <th>Periodo</th>
            <th>Carrera</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
          <tr>
            <td>{{ $usuario['nombreCompleto'] }}</td>
            <td>{{ $usuario['cedula'] }}</td>
            <td>{{ $usuario['correoElectronico'] }}</td>
            <td>{{ $usuario['ciudad'] }}</td>
            <td>{{ $usuario['cohorte'] }}</td>
            <td>{{ $usuario['periodo'] }}</td>
            <td>{{ $usuario['carrera'] }}</td>
            <td>
              <form action="{{ route('admin.eliminar', ['correoElectronico' => $usuario['correoElectronico']]) }}"
                method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?')">Rechazar</button>
              </form>
              <form action="{{ route('admin.aceptar', ['correoElectronico' => $usuario['correoElectronico']]) }}"
                method="post">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="text-muted">
      Total de datos: {{ count($usuarios) }}
    </div>
  </main>
</div>

<script>
  document.getElementById('searchInput').addEventListener('input', function () {
    searchTerm = this.value.toLowerCase();

    var rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function (row) {
      var fullName = row.cells[0].textContent.toLowerCase();
      var cedula = row.cells[1].textContent.toLowerCase();
      var email = row.cells[2].textContent.toLowerCase();
      var city = row.cells[3].textContent.toLowerCase();
      var cohort = row.cells[4].textContent.toLowerCase();
      var period = row.cells[5].textContent.toLowerCase();
      var career = row.cells[6].textContent.toLowerCase();

      if (fullName.includes(searchTerm) || cedula.includes(searchTerm) || email.includes(searchTerm) || city.includes(searchTerm) || cohort.includes(searchTerm) || period.includes(searchTerm) || career.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>

@endsection