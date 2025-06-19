<div class="main-container">
    <div class="container">
        <h1>Lista de Consultas</h1>

        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Estado de Respuesta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($consultas)): ?>
                <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?= esc($consulta['idConsulta']) ?></td>
                    <td><?= esc($consulta['nombre']) ?></td>
                    <td><?= esc($consulta['apellido']) ?></td>
                    <td><?= esc($consulta['correoElectronico']) ?></td>
                    <td><?= esc($consulta['asunto']) ?></td>
                    <td><?= esc($consulta['descripcion']) ?></td>
                    <td>
                        <?php
                            if ($consulta['idEstado'] == 1 && !empty($consulta['respuesta'])) {
                                echo 'Respondida';
                            } else {
                                echo 'Pendiente';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn-editar"
                            onclick="abrirModal(<?= $consulta['idConsulta'] ?>)">Atender Consulta</a>

                        <a href="<?= base_url('eliminarConsulta/' . $consulta['idConsulta']) ?>" class="btn-baja"
                            onclick="return confirm('¿Seguro que deseas eliminar esta consulta?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="9">No hay consultas registradas.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="<?= base_url('panelAdmin'); ?>" class="btn-Volver">Volver al Panel de Administración</a>
    </div>
</div>

<div id="modalAtender" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Responder Consulta</h2>
        <form id="formRespuesta" method="post" action="<?= base_url('atenderConsulta') ?>">
            <textarea name="respuesta" id="respuesta" rows="5" placeholder="Escriba su respuesta aquí..."
                required></textarea>
            <input type="hidden" id="idConsulta" name="idConsulta">
            <button type="submit">Confirmar</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="modalAtender" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Responder Consulta</h2>
        <form id="formRespuesta" method="post" action="<?= base_url('atenderConsulta') ?>">
            <textarea name="respuesta" id="respuesta" rows="5" placeholder="Escriba su respuesta aquí..."
                required></textarea>
            <input type="hidden" id="idConsulta" name="idConsulta">
            <button type="submit">Confirmar</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>

    </div>
</div>

<script>
function abrirModal(idConsulta) {
    document.getElementById("modalAtender").style.display = "flex";
    document.getElementById("idConsulta").value = idConsulta;
}


function cerrarModal() {
    document.getElementById("modalAtender").style.display = "none";
}

// Opcional: cerrar si hace clic afuera del contenido
window.onclick = function(e) {
    const modal = document.getElementById("modalAtender");
    if (e.target === modal) {
        cerrarModal();
    }
};

// Enviar el formulario por POST
document.getElementById("formRespuesta").onsubmit = function(e) {
    e.preventDefault();

    const idConsulta = document.getElementById("idConsulta").value;
    const respuesta = document.getElementById("respuesta").value;

    fetch("<?= base_url('atenderConsulta') ?>", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                idConsulta,
                respuesta
            })
        })
        .then(response => response.json())
        .then(data => {
            alert("Consulta respondida correctamente");
            location.reload();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un error al responder la consulta.");
        });
};
</script>

<style>
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background-color: #4b004d;
    color: white;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    position: relative;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
}

.modal-content .close {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 22px;
    cursor: pointer;
}

.modal-content textarea {
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    border: none;
    resize: vertical;
    font-size: 14px;
    margin-bottom: 20px;
}

.modal-content button {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-weight: bold;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    transition: 0.2s ease;
    border: none;
}

.modal-content button[type="submit"] {
    background-color: white;
    color: #4b004d;
}

.modal-content button[type="button"] {
    background-color: transparent;
    color: white;
    border: 2px solid white;
}
</style>


<style>
.btn-Volver {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
}

.btn-Volver:hover {
    background-color: #218838;
}

.btn-editar,
.btn-baja {
    padding: 4px 10px !important;
    font-size: 14px !important;
    border-radius: 4px !important;
    min-width: 0 !important;
    min-height: 0 !important;
    line-height: 1.2 !important;
}
</style>