const calendarEl = document.getElementById('calendar');
 
// Inicializar FullCalendar
const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    editable: true,

    // Cargar eventos desde el servidor
    events: function(fetchInfo, successCallback, failureCallback) {
     
    },

    // Añadir evento
    select: function (info) {
        const title = prompt('Título del evento:');
        if (title) {
        
        }
    },

    // Eliminar evento
    eventClick: function (info) {
        if (confirm('¿Deseas eliminar este evento?')) {
          
        }
    }
});

calendar.render();