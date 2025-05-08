import './bootstrap';
// JavaScript pour la fonctionnalité d'accordéon de la FAQ
const faqQuestions = document.querySelectorAll('.faq-question');

faqQuestions.forEach(question => {
  question.addEventListener('click', () => {
    const answer = question.nextElementSibling;
    const isActive = question.classList.contains('active');

    // Fermer toutes les autres réponses ouvertes
    faqQuestions.forEach(q => {
      if (q !== question && q.classList.contains('active')) {
        q.classList.remove('active');
        q.nextElementSibling.style.display = 'none';
      }
    });

    question.classList.toggle('active');
    answer.style.display = isActive ? 'none' : 'block';
  });
});