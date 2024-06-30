function addSkill() {
    var skillName = document.getElementById('skillName').value;
    var skillLevel = document.getElementById('skillLevel').value;

    if (skillName && skillLevel) {
        var skillList = document.getElementById('skillList');
        var listItem = document.createElement('li');
        listItem.textContent = `${skillName} - Niveau : ${skillLevel}`;
        skillList.appendChild(listItem);

        // Réinitialiser le formulaire
        document.getElementById('skillsForm').reset();
    } else {
        alert('Veuillez remplir tous les champs.');
    }
}