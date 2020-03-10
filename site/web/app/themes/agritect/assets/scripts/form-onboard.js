/* STEP QUESTION FORMAT */
/*

allQuestions is an object of all questions.
Each possible answer is an object containing:
- question: the literal question text
- text: subtext, below the question
- name: a unique identifier, predetermined for each question
- type: icon, radio, checkbox, location, userauth
- checkbox: (for type: icon) true, if multiple can be selected
- customClass: adds any class to a question
- options: a set of objects, one per response, containing:
  - text: the literal text of the response
    -- strings containing a bar ("|") will be split, the second half as subtext
  - name: a unique identifier, predetermined for each question
  - icon: (for type: icon) the image file corresponding to the answer
  */

  allQuestions = new Array();

/*allQuestions = [
  {
    question: 'How many team members are working on this project, including yourself?',
    name: "members",
    type: 'radio',
    options: [
      {
        text: '1 (Just Me)',
        name: '1',
      },
      {
        text: '2-3',
        name: '2',
      },
      {
        text: '4-6',
        name: '4',
      },
      {
        text: '7+',
        name: '7',
      },
    ]
  },

  {
    question: 'Enter your email to see your concept report!',
    text: 'We will email you a copy of the result and save your progress in your account',
    type: 'userAuth',
  },
]


n*/

allQuestions = [
{
  question: 'Define your primary role as it relates to your project.',
  badge: 'Your Role',
  name: 'role',
  type: 'icon',
  options: [
  {
    "text": "Farm owner or landowner",
    "name": "farm_owner",
    "icon": "role/owner.svg"
  },
  {
    "text": "Farmer or farm operator",
    "name": "farm_operator",
    "icon": "role/farmer.svg"
  },
  {
    "text": "Real Estate Developer",
    "name": "re_developer",
    "icon": "role/real-estate.svg"
  },
  {
    "text": "Architect or planner",
    "name": "architect",
    "icon": "role/architect.svg"
  },
  {
    "text": "Entrepreneur",
    "name": "entrepreneur",
    "icon": "role/entrepreneur.svg"
  },
  {
    "text": "Investor or financier",
    "name": "investor",
    "icon": "role/investor.svg"
  },
  {
    "text": "Other",
    "name": "other",
    'icon': "general/other.svg",
  },
  ],
},

{
  question: 'What are your primary goals for your project?',
  badge: 'Goals',
  text: '(Select up to 2)',
  name: 'goals',
  type: 'icon',
  checkbox: true,
  checkboxlimit: 2,
  options: [
  {
    "text": "Profit",
    "name": "profit",
    "icon": "goals/profit.svg"
  },
  {
    "text": "Research & Development",
    "name": "r_and_d",
    "icon": "goals/r_and_d.svg"
  },
  {
    "text": "Education",
    "name": "education",
    "icon": "goals/education.svg"
  },
  {
    "text": "Environmental Benefit",
    "name": "environmental",
    "icon": "goals/environmental.svg"
  },
  {
    "text": "Jobs & Training",
    "name": "jobs",
    "icon": "goals/jobs.svg"
  },
  {
    "text": "Economic Development",
    "name": "economic_dev",
    "icon": "goals/economic_dev.svg"
  },
  {
    "text": "Community-Related" ,
    "name": "community",
    "icon": "goals/community.svg"
  },
  {
    "text": "Aesthetic",
    "name": "aesthetic",
    "icon": "goals/aesthetic.svg"
  },
  ]
},

{
  question: 'How many team members are working on this project, including yourself?',
  badge: 'Team Members',
  name: "members",
  type: 'radio',
  options: [
  {
    text: '1 (Just Me)',
    name: '1',
  },
  {
    text: '2-3',
    name: '2',
  },
  {
    text: '4-6',
    name: '4',
  },
  {
    text: '7+',
    name: '7',
  },
  ]
},

{
  question: 'Which of the following best describes the stage of your project?',
  badge: 'Project Stage',
  name: 'stage',
  type: 'icon',
  options: [
  {
    "text": "Researching and formulating ideas",
    "name": "researching",
    'icon': "stage/research.svg",
  },
  {
    "text": "Developing or validating a business plan",
    "name": "developing",
    'icon': "stage/business-plan.svg",
  },
  {
    "text": "Looking to secure a building or property",
    "name": "property",
    'icon': "stage/building-or-property.svg",
  },
  {
    "text": "Currently operating but looking to scale",
    "name": "operating",
    'icon': "stage/scale.svg",
  },
  {
    "text": "Other",
    "name": "other",
    'icon': "general/other.svg",
  },
  ],
},

{
  question: 'What type of farming operations are you considering?',
  badge: 'Operating Models',
  text: '(Check all that apply)',
  name: 'farm_type',
  type: 'icon',
  checkbox: true,
  options: [
  {
    "text": "All urban farming types",
    "name": "all",
    'icon': "farm_type/all-urban-farming-types.svg",
    'toggle': 'all',
  },
  {
    "text": "Vertical Farm",
    "name": "vertical",
    'icon': "farm_type/vertical-farm.svg",
  },
  {
    "text": "Greenhouse",
    "name": "greenhouse",
    'icon': "farm_type/greenhouse.svg",
  },
  {
    "text": "Rooftop Farm",
    "name": "rooftop",
    'icon': "farm_type/rooftop-farm.svg",
  },
  {
    "text": "In-Ground Farm",
    "name": "in_ground",
    'icon': "farm_type/in-ground-farm.svg",
  },
  {
    "text": "Aquaponics",
    "name": "aquaponics",
    'icon': "farm_type/aquaponics.svg",
  },
  {
    "text": "Hydroponics",
    "name": "hydroponics",
    'icon': "farm_type/hydroponics.svg",
  },
  {
    "text": "Soil",
    "name": "soil",
    'icon': "farm_type/soil.svg",
  },
  ],
},

{
  question: 'Define the level of farming experience that your most experienced team member has.',
  badge: 'Experience',
  name: 'experience',
  type: 'radio',
  customClass: 'detailed',
  options: [
  {
    text: "Beginner|little to no farming background",
    name: 'beginner',
  },
  {
    text: "Light|familiarity with garden-scale or brief farming experience",
    name: 'light',
  },
  {
    text: "Medium|1-2 years commercial-scale experience",
    name: 'medium',
  },
  {
    text: "Proficient|3-6 years commercial-scale experience",
    name: 'proficient',
  },
  {
    text: "Master|7+ years of commercial-scale experience",
    name: 'master',
  },
  {
    text: "Looking to Hire|I am looking for an experienced grower or an operating team",
    name: 'looking',
  },
  ],
},

{
  question: 'What is your expected budget for this project?',
  badge: 'Budget',
  name: 'budget',
  type: 'radio',
  options: [
  {
    text: "< $25,000 USD",
    name: '0',
  },
  {
    text: "$25,000 - $100,000 USD",
    name: '25',
  },
  {
    text: "$100,000 - $250,000 USD",
    name: '100',
  },
  {
    text: "$250,000 - $1,000,000 USD",
    name: '250',
  },
  {
    text: "$1,000,000 - $5,000,000 USD",
    name: '1000',
  },
  {
    text: "$5,000,000+ USD",
    name: '5000',
  },
  ]
},

{
  question: 'Where are you considering developing your project?',
  badge: 'Location Type',
  name: 'locale',
  type: 'icon',
  checkbox: true,
  options: [
  {
    text: "City center",
    name: 'city',
    icon: "locale/city.svg",
  },
  {
    text: "Peri-urban area",
    name: 'periurban',
    icon: "locale/periurban.svg",
  },
  {
    text: "Suburban area",
    name: 'suburban',
    icon: "locale/suburban.svg",
  },
  {
    text: "Rural area",
    name: 'rural',
    icon: "locale/rural.svg",
  },
  ]
},

{
  question:'What crops are you interested in growing?',
  badge: 'Crops',
  name: 'crop',
  type: 'icon',
  customClass: 'detailed',
  checkbox: true,
  options: [
  {
    text: "Microgreens",
    name: 'microgreens',
    icon: "crops/microgreens.svg"
  },
  {
    text: "Leafy greens|(lettuce, kale, chard)",
    name: 'leafy_greens',
    icon: "crops/leafy-greens.svg"
  },
  {
    text: "Herbs|(mint, rosemary, thyme)",
    name: 'herbs',
    icon: "crops/herbs.svg"
  },
  {
    text: "Other vegetables|(squash, root veggies)",
    name: 'other_veg',
    icon: "crops/other-vegetables.svg"
  },
  {
    text: "Vining crops|(tomato, cucumber)",
    name: 'vining',
    icon: "crops/vining-crops.svg"
  },
  {
    text: "Berries|(strawberries, blueberries)",
    name: 'berries',
    icon: "crops/berries.svg"
  },
  {
    text: "Mushrooms",
    name: 'mushrooms',
    icon: "crops/mushrooms.svg"
  },
  {
    text: "Other",
    name: 'other',
    icon: "general/other.svg"
  },
  ],
},

{
  question: 'How do you plan to sell your crops?',
  badge: 'Distribution',
  text: '(Check all that apply)',
  name: 'distribution',
  type: 'icon',
  checkbox: true,
  options: [
  {
    text: "Wholesale",
    name: 'wholesale',
    icon: "distribution/wholesale.svg"
  },
  {
    text: "Direct to Retail",
    name: 'direct_retail',
    icon: "distribution/retail.svg"
  },
  {
    text: "Restaurants",
    name: 'restaurants',
    icon: "distribution/restaurants.svg"
  },
  {
    text: "Farmers Market",
    name: 'farmers_market',
    icon: "distribution/farmer-market.svg"
  },
  {
    text: "Direct to Consumers",
    name: 'direct_consumer',
    icon: "distribution/direct-to-consumer.svg"
  },
  {
    text: "Community Distribution",
    name: 'community',
    icon: "distribution/community-distribution.svg"
  }
  ],
},

{
  question: 'Help us understand the location you are targeting for your project.',
  type: "locationSelect",
},

{
  question: 'Enter your email to see your concept report!',
  text: "We will display your concept report on the next page and save your progress in your account.",
  type: 'userAuth',
},

];

allQuestions.forEach(function (element, count) {
  count++;
  element.index = count;
});

