const container = document.getElementById('container');

const swapy = Swapy.createSwapy(container, {
  animation: 'dynamic' 
});

function savePositions() {
  const slots = document.querySelectorAll('[data-swapy-slot]');
  const positions = {};

  slots.forEach((slot) => {
    const item = slot.querySelector('[data-swapy-item]');

    if (item) positions[item.getAttribute('data-swapy-item')] = slot.getAttribute('data-swapy-slot');
    
  });

  localStorage.setItem('swapyPositions', JSON.stringify(positions));
}

function loadPositions() {
  const savedPositions = localStorage.getItem('swapyPositions');

  return savedPositions ? JSON.parse(savedPositions) : {}
}

const positions = loadPositions();

['a', 'b', 'c'].forEach((itemName) => {
  const item = document.querySelector(`[data-swapy-item="${itemName}"]`);
  const targetSlot = document.querySelector(`[data-swapy-slot="${positions[itemName]}"]`);

  if (item && targetSlot) targetSlot.appendChild(item);  
});

swapy.onSwap(() => savePositions());

swapy.enable(true);
