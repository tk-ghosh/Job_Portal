function openSection(sectionId) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.tablink').forEach(t => t.classList.remove('active'));
  document.getElementById(sectionId)?.classList.add('active');
  document.querySelector(`.tablink[onclick*="${sectionId}"]`)?.classList.add('active');
}

const salaryData = {
  'software-engineer': { dhaka: [50000, 120000], chittagong: [45000, 100000], remote: [60000, 150000] },
  'data-scientist': { dhaka: [60000, 150000], chittagong: [55000, 130000], remote: [70000, 180000] },
  'product-manager': { dhaka: [70000, 160000], chittagong: [60000, 140000], remote: [80000, 200000] }
};

const benefitsData = {
  'software-engineer': ['Health Insurance', 'Stock Options', 'Flexible Hours', 'Learning Budget', 'Gym Membership'],
  'data-scientist': ['Health Insurance', 'Stock Options', 'Conference Budget', 'Remote Work', 'Flexible Hours'],
  'product-manager': ['Health Insurance', 'Performance Bonus', 'Stock Options', 'Flexible Hours', 'Travel Allowance']
};

function estimateSalary() {
  const position = document.getElementById('position').value;
  const location = document.getElementById('location').value;
  const result = document.getElementById('estimator-result');
  const data = salaryData[position]?.[location];
  if (data) {
    result.innerHTML = `<div style="background:#e8f5e9;padding:15px;border-radius:5px;">
      <p><strong>Estimated Range:</strong> $${data[0].toLocaleString()} - $${data[1].toLocaleString()}</p>
      <p><strong>Median:</strong> $${Math.round((data[0] + data[1]) / 2).toLocaleString()}</p>
    </div>`;
    result.style.display = 'block';
  } else {
    result.innerHTML = '<p style="color:#f44336;">Please select both position and location.</p>';
  }
}

function compareOffers() {
  const o1p = document.getElementById('offer1-position').value;
  const o1s = parseFloat(document.getElementById('offer1-salary').value) || 0;
  const o1b = parseFloat(document.getElementById('offer1-bonus').value) || 0;
  const o2p = document.getElementById('offer2-position').value;
  const o2s = parseFloat(document.getElementById('offer2-salary').value) || 0;
  const o2b = parseFloat(document.getElementById('offer2-bonus').value) || 0;

  const table = document.getElementById('comparison-table');
  const result = document.getElementById('comparison-result');
  table.style.display = 'table';
  result.innerHTML = `
    <tr>
      <td>Offer 1</td>
      <td>${o1p.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
      <td>$${o1s.toLocaleString()}</td>
      <td>$${o1b.toLocaleString()}</td>
      <td><strong>$${(o1s + o1b).toLocaleString()}</strong></td>
    </tr>
    <tr>
      <td>Offer 2</td>
      <td>${o2p.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
      <td>$${o2s.toLocaleString()}</td>
      <td>$${o2b.toLocaleString()}</td>
      <td><strong>$${(o2s + o2b).toLocaleString()}</strong></td>
    </tr>
  `;
}

function showBenefits() {
  const position = document.getElementById('benefits-position').value;
  const list = document.getElementById('benefits-list');
  const data = benefitsData[position];
  if (data) {
    list.innerHTML = data.map(b => `<li style="padding:8px;background:#f8f9fa;margin:5px 0;border-radius:4px;">${b}</li>`).join('');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.tablink').forEach(tab => {
    tab.addEventListener('click', function() {
      document.querySelectorAll('.tablink').forEach(t => t.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
