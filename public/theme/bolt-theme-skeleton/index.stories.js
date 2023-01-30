import twigQuestion from "./partials/_question.twig";
import {buildStory} from "./.storybook/async-helper";

export default {
  title: "Single Question",
  argTypes: {
    allowSolutions: {
      control: {
        type: "boolean"
      },
    },
  },
}

const Template = ({question, allowSolutions}) =>
  twigQuestion({question, allowSolutions});

export const Default = buildStory({
  allowSolutions: true,
  question: {
    question: "What... is your favourite colour?",
    answers: [
      {
        answer: "blue",
        "correct": true
      }, {
        answer: "yell...",
        "correct": false
      }
    ]
  }
}, Template);

export const ManyAnswers = buildStory({
  allowSolutions: true,
  question: {
    question: "What... is your favourite colour?",
    answers: [
      {
        answer: "blue",
        "correct": true
      }, {
        answer: "yell...",
        "correct": false
      }, {
        answer: "green",
        "correct": false
      }, {
        answer: "brown",
        "correct": false
      }, {
        answer: "black",
        "correct": false
      }, {
        answer: "cyan",
        "correct": false
      }, {
        answer: "lightgreen",
        "correct": false
      }, {
        answer: "darkgray",
        "correct": false
      }, {
        answer: "white",
        "correct": false
      }, {
        answer: "teal",
        "correct": false
      }, {
        answer: "lightsteelblue",
        "correct": false
      }
    ]
  }
}, Template)
