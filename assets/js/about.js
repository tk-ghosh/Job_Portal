document.addEventListener('DOMContentLoaded', function() {
    
    const featureCards = document.querySelectorAll('.feature-card');
    const missionVision = document.querySelector('.mission-vision');
    const teamMembers = document.querySelectorAll('.team-member');

   
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    
    featureCards.forEach(card => observer.observe(card));
    if (missionVision) observer.observe(missionVision);
    teamMembers.forEach(member => observer.observe(member));

    
    teamMembers.forEach(member => {
        const img = member.querySelector('img');
        if (img) {
            member.addEventListener('mouseenter', () => {
                img.style.transform = 'scale(1.1)';
                img.style.transition = 'transform 0.3s ease';
            });
            member.addEventListener('mouseleave', () => {
                img.style.transform = 'scale(1)';
            });
        }
    });

    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.classList.add('loaded');
        });
    });
}); 