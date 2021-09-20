<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">15</span>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header" id="quant"></span>
    <div id="notificacoes"></div>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
  </div>
</li>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

  function getContent()
  {
    try {
      const response = axios.get('/notifications/getNotifications/').then(function (response) { // handle success 
        show(response.data); })
    } catch (error) {
      console.error(error);
    }
  }

  function show(notifications)
  {
    let output = ''

    for(let notification of notifications){
      output += `<div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> ${notification.title}
                  </a>`
    }

    document.getElementById('notificacoes').innerHTML = output;
    document.getElementById('quant').innerHTML = notifications.length+' notificações.'
  }

  getContent()

  setInterval(getContent, 120 * 1000)

</script>
