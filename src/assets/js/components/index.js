import HomeContainer from './HomeContainer'
import ProjectsContainer from './ProjectsContainer';
import ObjectsContainer from './ObjectsContainer';
import ProjectContainer from './ProjectContainer';
import ObjectContainer from './ObjectContainer';
import AboutContainer from './AboutContainer';
import ContactContainer from './ContactContainer';

const components = [
  {
    class: HomeContainer,
    namespace: 'HomeContainer',
    selector: '.home-container',
    smController: false
  },
  {
    class: ProjectsContainer,
    namespace: 'ProjectsContainer',
    selector: '.projects-container',
    smController: false
  },
  {
    class: ObjectsContainer,
    namespace: 'ObjectsContainer',
    selector: '.objects-container',
    smController: false
  },
  {
    class: ProjectContainer,
    namespace: 'ProjectContainer',
    selector: '.project-container',
    smController: false
  },
  {
    class: ObjectContainer,
    namespace: 'ObjectContainer',
    selector: '.object-container',
    smController: false
  },
  {
    class: AboutContainer,
    namespace: 'AboutContainer',
    selector: '.about-container',
    smController: false
  },
  {
    class: ContactContainer,
    namespace: 'ContactContainer',
    selector: '.contact-container',
    smController: false
  }
]

export default components