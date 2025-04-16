let cards = JSON.parse(localStorage.getItem('cards')) || [];
let editIndex = -1;

document.addEventListener('DOMContentLoaded', () => {
    renderCards();
});

document.getElementById('cardForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('cardTitle').value;
    const imageFile = document.getElementById('cardImage').files[0];
    
    if (!title || !imageFile) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const card = {
            title: title,
            image: e.target.result
        };
        
        if (editIndex === -1) {
            cards.push(card);
        } else {
            cards[editIndex] = card;
            editIndex = -1;
        }

        saveCards();
        renderCards();
        this.reset();
    }.bind(this);
    
    reader.readAsDataURL(imageFile);
});

function renderCards() {
    const cardsList = document.getElementById('cardsList');
    cardsList.innerHTML = '';
    
    cards.forEach((card, index) => {
        const cardElement = document.createElement('div');
        cardElement.className = 'card';
        cardElement.innerHTML = `
            <h3>${card.title}</h3>
            <img src="${card.image}" alt="${card.title}">
            <div class="card-actions">
                <button class="edit-btn" onclick="editCard(${index})">Modifier</button>
                <button class="delete-btn" onclick="deleteCard(${index})">Supprimer</button>
            </div>
        `;
        cardsList.appendChild(cardElement);
    });
}

function editCard(index) {
    const card = cards[index];
    document.getElementById('cardTitle').value = card.title;
    editIndex = index;
}

function deleteCard(index) {
    cards = cards.filter((_, i) => i !== index);
    saveCards();
    renderCards();
}

function saveCards() {
    localStorage.setItem('cards', JSON.stringify(cards));
}
