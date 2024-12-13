<template>
    <div>
      <h1>Task Manager</h1>
      <form @submit.prevent="addTask">
        <label for="title">Title</label>
        <input type="text" v-model="title" id="title" required />
  
        <label for="description">Description</label>
        <input type="text" v-model="description" id="description" required />
  
        <button type="submit">Add Task</button>
      </form>
  
      <div v-if="tasks.length">
        <ul>
          <li v-for="task in tasks" :key="task.id">{{ task.title }} - {{ task.description }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  import axios from "axios";
  
  export default {
    name: "TaskComponent",
    data() {
      return {
        title: "",
        description: "",
        tasks: [],
      };
    },
    methods: {
      async addTask() {
        try {
          // Send POST request to create task
          const response = await axios.post("/api/tasks", {
            title: this.title,
            description: this.description,
          });
  
          // If the task was added successfully, add it to the tasks array
          this.tasks.push(response.data);
  
          // Reset form inputs
          this.title = "";
          this.description = "";
        } catch (error) {
          console.error("Error adding task:", error.response ? error.response.data : error.message);
        }
      },
    },
    mounted() {
      // Fetch tasks when the component mounts
      axios
        .get("/api/tasks")
        .then((response) => {
          this.tasks = response.data;
        })
        .catch((error) => {
          console.error("Error fetching tasks:", error);
        });
    },
  };
  </script>
  