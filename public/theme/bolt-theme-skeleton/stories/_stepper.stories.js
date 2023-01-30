import stepperTwig from "./../partials/_stepper.twig";
import {buildStory} from "./../.storybook/async-helper";

export default {
  title: "Stepper",
  argTypes: {
    current: {
      control: {
        type: "number",
        min: 1,
        max: 6,
      },
      defaultValue: 1
    },
  },
}

const Template = ({current}) =>
  stepperTwig({
    steps: [1,2,3,4,5,6],
    current
  });

export const Default = buildStory({
}, Template);
