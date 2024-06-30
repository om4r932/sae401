let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let log =document.querySelector(".profile");
let content = document.querySelector('.section');
const leftColumn = document.querySelector('.container');
// Vérifiez si les éléments existent avant d'ajouter des écouteurs d'événements
if (closeBtn) {
    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
		sidebar.style.borderRadius = '0';
		toggleSidebar()
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
		toggleSidebar()
    });
}

function toggleSidebar() {
	// Appliquer le changment de border-radius
	if (sidebar.classList.contains('open')) {
	  sidebar.style.borderRadius = '0';
	  log.style.borderRadius = '0';
      leftColumn.style.gridTemplateColumns = '15rem auto 15rem';
	} 
	
	else {
		sidebar.style.borderTopRightRadius = '22px'; 
		sidebar.style.borderBottomRightRadius = '22px';  
		log.style.borderBottomRightRadius = '22px';  
        leftColumn.style.gridTemplateColumns = '5rem auto 21rem';
        	}
  }

function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}
